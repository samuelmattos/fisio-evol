let btn_insecrever = document.querySelector('#btn_insecrever');

btn_insecrever.onclick = function(){
    axios.post('user/inscrever').then((response)=> {
        console.log(response.data);
    });   
};