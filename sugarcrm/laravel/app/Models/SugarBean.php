<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SugarBean extends Model
{
    use HasFactory;

    protected $guarded = [];
    //protected $fillable = ['id', 'name', 'description'];

    public $moduleVardefs = [];

    protected $relations = [
        'one-to-many',
        'many-to-many'
    ];

    public function __construct() {
        global $moduleVardefs;

        $className = get_class($this);
        if ( isset($moduleVardefs[$className]) ) {
            $moduleVardefs[$className]['fields'] = array_merge($moduleVardefs[$className]['fields'], [
                'name' => ['type'=>'string', 'length' => 255, 'default' => null, 'null' => true],
                'description' => ['type'=>'text', 'length' => 255, 'default' => null, 'null' => true]
            ]);
            $this->moduleVardefs = $moduleVardefs[$className];
        } else {
            throw new \Exception("Bean instantiation failed. Module definition for {$className} not found.");
        }
    }
    /**
     * @param $id The model id
     */
    public function retrieve($id=null) {
        $id = $id ?? $this->id;
        $model = self::find($id);
        if ( $model ) {
            $this->fill($model->toArray());
        }
        return $this;
    }

    public function retrieve_by_string_fields($fields = []) {
        $model = self::query();

        foreach ( $fields as $field => $value ) {
            $model->where($field, '=', $value);
        }

        $model = $model->first();
        if ( $model ) {
            $this->fill($model->toArray());
        }
        return $this;
    }

    public function load_relationship($beanName) {
        $relatedModules = $this->moduleVardefs['related_modules'];
        if ( isset($relatedModules[$beanName]) ) {
            $bean = $this;
            $this->{$beanName} = new class {
                public $bean;
                public $beanName;
                public $relatedModules;

                function add($relationBean) {
                    $relationBeanName = get_class($relationBean);
                    if ( $this->beanName != $relationBeanName ) {
                        throw new \Exception("Tried adding invalid bean `$relationBeanName` to relation `{$this->beanName}`");
                    } else {
                        foreach($this->relatedModules as $_beanName => $relatedModule) {
                            if ( $_beanName == $this->beanName ) {
                                switch($relatedModule['relationship_type']) {
                                    case 'one-to-many':
                                        $this->bean->hasMany($this->beanName, $relatedModule['relation_key_rhs'])->associate($relationBean);
                                        break;
                                    case 'many-to-one':
                                        $this->bean->{$relatedModule['relation_key_lhs']} = $relationBean->id;
                                        $this->bean->save();
                                        break;
                                    case 'many-to-many':
                                        $this->bean->belongsToMany($this->beanName, $relatedModule['join_table'], $relatedModule['join_key_lhs'], $relatedModule['join_key_rhs'])->attach($relationBean->id);
                                        break;
                                }
                                break;
                            }
                        }
                    }
                }

                function remove($relationBean) {
                    $relationBeanName = get_class($relationBean);
                    if ( $this->beanName != $relationBeanName ) {
                        throw new \Exception("Tried adding invalid bean `$relationBeanName` to relation `{$this->beanName}`");
                    } else {
                        foreach($this->relatedModules as $_beanName => $relatedModule) {
                            if ( $_beanName == $this->beanName ) {
                                switch($relatedModule['relationship_type']) {
                                    case 'one-to-many':
                                        $relationBean->{$relatedModule['relation_key_rhs']} = null;
                                        $relationBean->save();
                                        break;
                                    case 'many-to-one':
                                        $this->bean->{$relatedModule['relation_key_lhs']} = $relationBean->id;
                                        $this->bean->save();
                                        break;
                                    case 'many-to-many':
                                        $this->bean->belongsToMany($this->beanName, $relatedModule['join_table'], $relatedModule['join_key_lhs'], $relatedModule['join_key_rhs'])->detach($relationBean->id);
                                        break;
                                }
                                break;
                            }
                        }
                    }
                }
            };
            $this->{$beanName}->bean = $bean;
            $this->{$beanName}->beanName = $beanName;
            $this->{$beanName}->relatedModules = $relatedModules;
        } else {
            throw new \Exception("Tried loading invalid relationship `$beanName` for bean `" . get_class($this) . "`");
        }
    }

    public function get_linked_beans(String $beanName) {
        $relatedBeans = $this->get_all_linked_beans();
        return isset($relatedBeans[$beanName]) ? $relatedBeans[$beanName] : [];
    }

    public function get_all_linked_beans() {
        $relatedBeans = [];
        $relatedModules = $this->moduleVardefs['related_modules'];

        foreach($relatedModules as $beanName => $relatedModule) {
            switch($relatedModule['relationship_type']) {
                case 'one-to-many':
                    $relatedBeans[$beanName] = $this->hasMany($beanName, $relatedModule['relation_key_rhs'])->get()->toArray();
                    break;
                case 'many-to-one':
                    $relatedBeans[$beanName] = $this->belongsTo($beanName, $relatedModule['relation_key_lhs'])->get()->toArray();
                    break;
                case 'many-to-many':
                    $relatedBeans[$beanName] = $this->belongsToMany($beanName, $relatedModule['join_table'], $relatedModule['join_key_lhs'], $relatedModule['join_key_rhs'])->get()->toArray();
                    break;
            }
        }

       return $relatedBeans;
    }

    public function save($options = []) {
        $data = $this->getAttributes();

        unset($data['id']);
        unset($data['created_at']);
        unset($data['updated_at']);
        
        $className = get_class($this);
        if ( !empty($this->id) ) {
            return $className::where('id', $this->id)->update($data);
        } else {
            return $className::insert($data);
        }
    }

}
