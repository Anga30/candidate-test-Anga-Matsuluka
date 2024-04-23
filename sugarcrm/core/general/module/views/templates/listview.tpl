<table class="table table-striped">
    <tr>
        {foreach $columnDefs as $fieldName}
            <th>{$fieldName}</th>
        {/foreach}
    </tr>
    {foreach $beans as $bean}
        <tr>
            {foreach $columnDefs as $fieldName}
                {if $fieldName@first}
                    <td><a href="/module/{$beanName}/{$bean['id']}/detail">{$bean[$fieldName]}</a></td>
                {else}
                    <td>{$bean[$fieldName]}</td>
                {/if}
            {/foreach}
        </tr>
    {/foreach}
</table>