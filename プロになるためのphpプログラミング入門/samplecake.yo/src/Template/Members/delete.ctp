<form name="post_xxx" 
    style="display:none;" 
    method="post" 
    action="/members/delete/ID番号">
    <input type="hidden" name="_method" 
    value="POST"/>
</form>
<a href="#" onclick="if (confirm(○○)) 
    { document.post_xxx.submit(); } 
    event.returnValue = false; 
    return false;">Delete</a>
