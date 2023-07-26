
export default class Role {

  
      GetCookie(name)
      {
          var nameEQ = name + "=";
          var ca = document.cookie.split(';');
          for (var i = 0; i < ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0) == ' ') c = c.substring(1, c.length);
              if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
          }
          return null;


      }


      SetLocalStroge(access){

        let formData = new FormData();
        formData.append('access', access);
        axios.post('/api/role/check', formData).then((response) => {
                const list  = localStorage.getItem('root_vue'); 
                if(list ==null || JSON.parse(list).length ==0)
                {
                   localStorage.setItem('apps', response.data.apps);  
                   localStorage.setItem('root_vue', JSON.stringify(response.data.result)); 
                } 
           }).catch((error) => {
          
           
        }) 
      }
     
}