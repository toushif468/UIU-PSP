const form = document.querySelector(".login_page form"),
submitBtn = document.querySelector(".login_page form button"),
errorTxt = document.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

submitBtn.onclick = ()=>{
    console.log("onclick ");
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/login.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log("onclick ");

                let data = xhr.response;
                if(data == "success"){
                    location.href = "index.php";
                }
                else{
                    errorTxt.textContent = data;
                    errorTxt.style.display = "block";
                }
                // console.log(data);

            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);

}