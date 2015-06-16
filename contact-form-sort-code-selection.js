function cfscs_add(x)
{
    
    var y = document.getElementById ("contacta");
    title = y.options[y.selectedIndex].text;
    
    text = "[contact-form-7  id=" + y.value + " title='"+title+"']";
          
         if ( typeof tinyMCE != 'undefined'){
            var editorE = tinymce.get( 'content' );  
          if(editorE && editorE instanceof tinymce.Editor){
            editorE.focus();
            text = '<div>' + text + editorE.selection.getContent() + '</div>';
            editorE.execCommand(tinymce.isGecko ? 'insertHTML' : 'mceInsertContent', false, text);
            //tinyMCE.get('content-textarea-clone').setContent(text);

        } 
           document.getElementById("content").value += text;
            
           
       
      } 
             
}

function myNewFunction(sel)
{
     add(sel)
    
}