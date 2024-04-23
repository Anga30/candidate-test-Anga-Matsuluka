<h3>{$moduleLabel}</h3>
<br><br>
<form method="put" action="/module/{$beanName}/{$beanArray['id']}">
    <input type="hidden" name="_token" value="{$csrf_token}" />
    <table class="table table-module-detail table-striped-columns">
        {foreach $viewFieldDefs as $rowDefs}
            <tr>
                {if isset($rowDefs[0])}
                    <th>{$rowDefs[0]}:</th>
                    <td>
                        {if $fieldDefs[$rowDefs[0]]['type'] == "boolean"}
                            <div class="form-check">
                                <input class="form-check-input" name="{$rowDefs[0]}" type="checkbox" value="1" {if $beanArray[$rowDefs[0]]}checked{/if}/>
                            </div>
                        {else}
                            <input type="text" class="form-control {if isset($errors[$rowDefs[0]])}is-invalid{/if}" name="{$rowDefs[0]}" value="{if isset($oldData[$rowDefs[0]])}{$oldData[$rowDefs[0]]}{else}{$beanArray[$rowDefs[0]]}{/if}" />
                        {/if}
                        {if isset($errors[$rowDefs[0]])}
                            {foreach $errors[$rowDefs[0]] as $errorMessage}
                                <div class="invalid-feedback">
                                    {$errorMessage}
                                </div>
                            {/foreach}
                        {/if}
                    </td>
                {else}
                    <th>{* Empty *}</th><td>{* Empty *}</td>
                {/if}

                {if isset($rowDefs[1])}
                    <th>{$rowDefs[1]}:</th>
                    <td>
                        {if $fieldDefs[$rowDefs[1]]['type'] == "boolean"}
                            <div class="form-check">
                                <input class="form-check-input" name="{$rowDefs[1]}" type="checkbox" value="1" {if $beanArray[$rowDefs[1]]}checked{/if}/>
                            </div>
                        {else}
                            <input type="text"class="form-control {if isset($errors[$rowDefs[1]])}is-invalid{/if}" name="{$rowDefs[1]}" value="{if isset($oldData[$rowDefs[1]])}{$oldData[$rowDefs[1]]}{else}{$beanArray[$rowDefs[1]]}{/if}" />
                        {/if}
                        {if isset($errors[$rowDefs[1]])}
                            {foreach $errors[$rowDefs[1]] as $errorMessage}
                                <div class="invalid-feedback">
                                    {$errorMessage}
                                </div>
                            {/foreach}
                        {/if}
                    </td>
                {else}
                    <th>{* Empty *}</th><td>{* Empty *}</td>
                {/if}
            </tr>
        {/foreach}
    </table>
    <button class="btn btn-outline-secondary" type="submit">Save</a>
</form>