{config_load file='test.conf' section='setup'}
{#title#}
{include file="header.tpl" title=foo}
{if isset($Name)}
	{$Name}
{else}
	empty
{/if}
{foreach $row as $item}
	{$item.id}<br>
	{$item.name}<br>
	<hr>
{/foreach}
{$FirstName[0]}
{$LastName.Doe}

{include file="footer.tpl"}

