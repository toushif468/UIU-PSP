


// ---------------------------------------------------------Problem Post-------------------------------------------------------->




const answerPostBtn = document.querySelector(".answer-section .answer-post-btn"),
answerPostForm = document.querySelector(".answer-section .answer_post_form");

answerPostForm.onsubmit = (e)=>{
    e.preventDefalut();
}
answerPostBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/insert.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                location.href = "problem_panel.php?post_id="+data;
                // if(data == "success"){
                // }
            }
        }
    }
    let formData = new FormData(answerPostForm);
    formData.append("insertCode","insertAnswer");
    xhr.send(formData);
}


// ---------------------------------------------------------All ANSWER fetch-------------------------------------------------------->


const allAnswerContainer = document.querySelector(".all-answers");
let answersLength = 0;
// let ansCommentLength = 0;

setInterval(()=>{

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/getData.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = "";
                data = xhr.response;
                let dataSplit = data.split("*#");
                let ppNums = parseInt(dataSplit[0]);
                // let dataSplitPro = dataSplit[1];
                // console.log(ppNums);
                if(answersLength != ppNums){
                    allAnswerContainer.innerHTML = dataSplit[1];
                    answersLength = ppNums;
                    setAnswerCommentPostData();
                    fetchAnswerComment();
                    updateAnswer();
                    answerLikes();
                }else if(ppNums == 0){
                    allAnswerContainer.innerHTML = '<p style="margin-top: 30px;">There is no answer has been posted yet </p>';
                }
            }
        }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("getCode=getAnswers");




},1000);


// ---------------------------------------------------------Problem Comment Post-------------------------------------------------------->




const pCommentBtn = document.querySelector(".question-details .pblm-comment-submit-btn"),
pCommentForm = document.querySelector(".question-details .pblm-comment-form");

pCommentForm.onsubmit = (e)=>{
    e.preventDefault();
}
pCommentBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/insert.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200){
                let data = xhr.response;
                pCommentForm.reset();
                console.log(data);
                // location.href = "problem_panel.php?post_id="+data;
                // if(data == "success"){
                // }
            }
        }
    }
    let formData = new FormData(pCommentForm);
    formData.append("insertCode","insertPComment");
    xhr.send(formData);
}


// --------------------------------------------------------- Fetch all comments of problem -------------------------------------------------------->


const probCommentContainer = document.querySelector(".question-details .comment-texts");

let pCommentsLength = 0;

setInterval(()=>{

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/getData.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = "";
                data = xhr.response;
                // console.log(data);
                let dataSplit = data.split("*#");
                let ppNums = parseInt(dataSplit[0]);
                // console.log(dataSplit[0]);
                if(pCommentsLength != ppNums){
                    probCommentContainer.innerHTML = dataSplit[1];
                    probCommentContainer.scrollTop = probCommentContainer.scrollHeight;
                    pCommentsLength = ppNums;
                }
            }
        }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("getCode=getPComment");




},1000);



// ---------------------------------------------------------answer Comment Post-------------------------------------------------------->



let aCommentBtn, aCommentForm, answer_ids;

function setAnswerCommentPostData(){
    aCommentBtn = document.querySelectorAll(".answer-comment-submit-btn");
    aCommentForm = document.querySelectorAll(".answer-comment-form");
    answer_ids = document.querySelectorAll(".answer-comments .answer_id");
    // console.log(aCommentForm[1]);


    for (let i = 0; i < aCommentBtn.length; i++) {
        aCommentForm[i].onsubmit = (e)=>{
            e.preventDefault();
        }
        aCommentBtn[i].onclick = ()=>{
            let xhr = new XMLHttpRequest();
            xhr.open("POST","php/insert.php",true);
            xhr.onload = ()=>{
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if(xhr.status === 200){
                        let data = xhr.response;
                        aCommentForm[i].reset();
                        // console.log(data);
                        // location.href = "problem_panel.php?post_id="+data;
                        // if(data == "success"){
                        // }
                    }
                }
            }
            let formData = new FormData(aCommentForm[i]);
            formData.append("insertCode","insertAComment");
            formData.append("answer_id", answer_ids[i].innerHTML);
            xhr.send(formData);
        }
    }
}


//==================================== Fetch all answers comment ================================>


function fetchAnswerComment(){
    const ansCommentContainer = document.querySelectorAll(".answer-comments .a-comments");
    const forScroll = document.querySelectorAll(".answer-comments");
    const answer_id = document.querySelectorAll(".answer-comments .answer_id");
    let aCommentsLength = [];
    for (let i = 0; i < ansCommentContainer.length; i++){
        aCommentsLength[i] = 0;
    };

    setInterval(() => {
        for (let i = 0; i < ansCommentContainer.length; i++) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/getData.php", true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = "";
                        data = xhr.response;
                        // console.log(data);
                        let dataSplit = data.split("*#");
                        let ppNums = parseInt(dataSplit[0]);
                        if(aCommentsLength[i] != ppNums){
                            // console.log(ppNums+" - "+aCommentsLength[i]);
                            ansCommentContainer[i].innerHTML = dataSplit[1];
                            forScroll[i].scrollTop = forScroll[i].scrollHeight;
                            aCommentsLength[i] = ppNums;
                        }
                    }
                }
            }
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("getCode=getAComment&answer_id="+answer_id[i].innerHTML);
            
        }
    }, 1000);
}


// ==================================== problem post update ===============================>


const ppUpdateBtn = document.querySelector(".problem-post-update-btn"),
ppUpdateForm= document.querySelector(".problem-post-update-form");



ppUpdateBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                let ab = data.split(" - ");
                console.log(data);
                if(ab[0] == "success"){
                    location.href = "problem_panel.php?post_id="+ab[1];
                }
            }
        }
    }
    let formData = new FormData(ppUpdateForm);
    formData.append("updateCode", "updatePPost");
    xhr.send(formData);
}



// ==================================== problem post update ===============================>


function updateAnswer(){
const ansUpdateBtn = document.querySelectorAll(".answer-edit-btn"),
ansUpdateForm= document.querySelectorAll(".ans-update-form");

// ansUpdateBtn.forEach((element,i) => {
//     element.onclick = ()=>{

//         console.log(element + i);
//     }
    
// });

ansUpdateBtn.forEach((element,i) => {
    element.onclick = ()=>{
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/update.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    let ab = data.split(" - ");
                    console.log(data);
                    if(ab[0] == "success"){
                        location.href = "problem_panel.php?post_id="+ab[1];
                    }
                }
            }
        }
        let formData = new FormData(ansUpdateForm[i]);
        formData.append("updateCode", "ansUpdate");
        xhr.send(formData);
    }
    
});
}




//================================== Like Dislike ================================>


const likeBtn = document.querySelector(".p-like");
const pLikeCount = document.querySelector(".pLikeCount");
const user_id = document.querySelector(".user_id_p").innerHTML,
problem_id = document.querySelector(".problem_id_p").innerHTML;

likeBtn.onclick = ()=> {
    let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/count.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    let sd = data.split(" - ");
                    if(sd[0] == "liked"){
                        likeBtn.querySelector("i").style.color = "#5016ff";
                    }
                    else if(sd[0] == "unliked"){
                        likeBtn.querySelector("i").style.color = "#e1e1e1";
                    }
                    pLikeCount.innerHTML = sd[1];
                }
            }
        }
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("countCode=pLike&user_id="+ user_id+"&problem_id="+problem_id);
}


function answerLikes() {
    const alikeBtn = document.querySelectorAll(".a-like");
    const aLikeCount = document.querySelectorAll(".aLikeCount");
    const answer_id_Container = document.querySelectorAll(".answer_id_a");

    alikeBtn.forEach((btn,i) => {
        btn.onclick = ()=> {
            console.log("clicked");
            let xhr = new XMLHttpRequest();
                xhr.open("POST", "php/count.php", true);
                xhr.onload = ()=>{
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                            let data = xhr.response;
                            console.log(data);
                            let sd = data.split(" - ");
                            if(sd[0] == "liked"){
                                btn.querySelector("i").style.color = "#5016ff";
                            }
                            else if(sd[0] == "unliked"){
                                btn.querySelector("i").style.color = "#e1e1e1";
                            }
                            aLikeCount[i].innerHTML = sd[1];
                        }
                    }
                }
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("countCode=aLike&user_id="+ user_id+"&answer_id="+answer_id_Container[i].innerHTML);
        }
    });
    answerStar();
}

function answerStar() {
    const aStarBtn = document.querySelectorAll(".answer-accepted-star");

    aStarBtn.forEach(btn => {
        btn.onclick = ()=> {
            let xhr = new XMLHttpRequest();
                xhr.open("POST", "php/count.php", true);
                xhr.onload = ()=>{
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                            let data = xhr.response;
                            console.log(data);
                            if(data == "accepted"){
                                btn.style.color = "#5016ff";
                            }
                            else if(data == "notAccepted"){
                                btn.style.color = "#e1e1e1";
                            }
                        }
                    }
                }
                const answerId = btn.querySelector(".answer_id_star").innerHTML;
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("countCode=aStar&answer_id="+answerId);
        }
    });
}
