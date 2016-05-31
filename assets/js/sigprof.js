$(document).ready(function(){
   //Confirmar ação nos elementos .excluir
   $('.excluir').on('click', function(){
       if(confirm('Deseja realmente excluir?')){
           return true;
       }
       return false;
   });
});