<div class="accordion accordion-flush" id="accordionFlushExample">
  {foreach $groupedRelatedModuleBeans as $beanName => $relatedModuleBeans}
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{$beanName}" aria-expanded="false" aria-controls="flush-collapse{$beanName}">
          [{$beanName}]
        </button>
      </h2>
      <div id="flush-collapse{$beanName}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
          {if count($relatedModuleBeans)}
              <table class="table">
                <tr>
                  {foreach $moduleVardefs[$beanName]['list_view_fields'] as $fieldName}
                    <th>{$fieldName}</th>
                  {/foreach}
                </tr>
                {foreach $relatedModuleBeans as $relatedModuleBean}
                  <tr>
                    {foreach $moduleVardefs[$beanName]['list_view_fields'] as $fieldName}
                      {if $fieldName@first}
                          <td><a href="/module/{$beanName}/{$relatedModuleBean['id']}/detail">{$relatedModuleBean[$fieldName]}</a></td>
                      {else}
                          <td>{$relatedModuleBean[$fieldName]}</td>
                      {/if}
                    {/foreach}
                  </tr>
                {/foreach}
              </table>
            {else}
              <div class="alert alert-warning">No records here!</div>
            {/if}
          </div>
      </div>
    </div>
    {/foreach}
</div>