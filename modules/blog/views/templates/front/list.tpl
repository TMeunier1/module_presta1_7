<h1>Welcome to my blog</h1>
<ul>
    {foreach from=$posts item=post}
        <li><a href="{$post.link}">{$post.title} - {$post.date_add}</a></li>
    {/foreach}
</ul>
