$position = (localStorage.getItem("positionArray") === null) ? 0 : localStorage.getItem("positionArray");
$addFlow  = (localStorage.getItem("positionAdd") === null) ? 0 : localStorage.getItem("positionAdd");
$list  = (localStorage.getItem("array") === []) ? -1 : localStorage.getItem("array");
//verifing size and not null
console.log($list);

$hastList = ($list !== null) ?  ($list.lenght > 0) ?  true : false : false;  


$("").val($list[$num]);
if ($hastList) {        
    $list = $list.split("#####");
    console.log($list);
    $descriList  = ($descriList === null) ? -1 : localStorage.getItem("array2");
    $descriList = $descriList.split("#####");
    $title = $list[$position];
    $descri = $descriList[$position];
    console.log($descri);
    if (window.location.href == "https://www.tjrn.jus.br/administrator/index.php?option=com_docman&section=categories") {
        console.log("categorias");
        if ($title !== undefined) {
              setTimeout(function(){
                $('#toolbar-dm_newdocument>a').click();
            }, 30);
        } else {
            localStorage.setItem("positionAdd",0);
            localStorage.setItem("positionArray",0);
        }
    } else if ($addFlow == 1){
        console.log("cancelar");
        localStorage.setItem("positionAdd", 0);
        setTimeout(function() {
            $("#toolbar-dm_cancel>a").click();
        }, 40);
    } else {
        console.log("documento");
        $('select#parent_id').val("306");
        $("input[name='title']").val($title);
        $("input[name='name']").val($title);
        console.log($descri);
        console.log($title);
        $("#description").html($descri);
        $position++;
        localStorage.setItem("positionAdd", 1);
        localStorage.setItem("positionArray", $position);
        setTimeout(function(){
            $("#toolbar-dm_save a").click();
        }, 50);
    }
}