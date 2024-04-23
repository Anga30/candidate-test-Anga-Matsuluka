<h3>{$moduleLabel}</h3>
<a class="btn btn-outline-secondary" href="/module/{$beanName}/{$beanArray['id']}/edit" role="button">Edit</a><br><br>
<table class="table table-module-detail table-striped-columns">
    {foreach $viewFieldDefs as $rowDefs}
        <tr>
            {if isset($rowDefs[0])}
                <th>{$rowDefs[0]}:</th><td>
                    {if $fieldDefs[$rowDefs[0]]['type'] == "boolean"}
                        <div class="form-check">
                            <input class="form-check-input" disabled="disabled" type="checkbox" {if $beanArray[$rowDefs[0]]}checked{/if}>
                        </div>
                    {else}
                        {$beanArray[$rowDefs[0]]}
                    {/if}
                </td>
            {else}
                <th>{* Empty *}</th><td>{* Empty *}</td>
            {/if}

            {if isset($rowDefs[1])}
                <th>{$rowDefs[1]}:</th><td>
                    {if $fieldDefs[$rowDefs[1]]['type'] == "boolean"}
                        <div class="form-check">
                            <input class="form-check-input" disabled="disabled" type="checkbox" {if $beanArray[$rowDefs[1]]}checked{/if}>
                        </div>
                    {else}
                        {$beanArray[$rowDefs[1]]}
                    {/if}
                </td>
            {else}
                <th>{* Empty *}</th><td>{* Empty *}</td>
            {/if}
        </tr>
    {/foreach}
</table>