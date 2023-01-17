

// ----------------------- Question Paper Uploading -----------------------------------


const quesionUploadFrom = document.querySelector(".quesionUploadFrom"),
qpUploadBtn = document.querySelector(".qp-upload-btn");



qpUploadBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data == "success"){
                    location.href = "index.php";
                }
            }
        }
    }
    let formData = new FormData(quesionUploadFrom);
    formData.append("insertCode", "insertQP");
    xhr.send(formData);
}












// -------------------------------------- keyup suggestion -------------------------------------


// ============ for question paper upload ====>

const addCourseBtn = document.querySelector(".ques-upload-btn"),
addCourseCancelBtn = document.querySelectorAll(".ques-upload-cancel-btn");
let courses;
let courseCodes =[];

addCourseBtn.onclick = ()=>{ // -------------- Getting All course's info from database as object.
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/getData.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                courses = JSON.parse(data);
                for(let i=0; i<Object.keys(courses).length; i++){
                    courseCodes.push(courses[i]["course_title"]+" - "+courses[i]["course_code"]); // taking only course codes
                }
            }
        }
    }
    let Data = "t3t";
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("getCode="+ Data);

    
}


let input = document.getElementById("courseCode");
const courseIDList = document.querySelector(".pp-course-search-list");


addCourseCancelBtn.forEach(element => {
    element.onclick=()=>{
        courseCodes = [];
        quesionUploadFrom.reset();
        removeElements();
    }
});
//Execute function on keyup
input.addEventListener("keyup", (e) => {



    removeElements(); //Initially remove all elements ( so if user erases a letter or adds new letter then clean previous outputs)
    for (let i of courseCodes) {
        //convert input to lowercase and compare with each string

        if (
            i.toLowerCase().includes(input.value.toLowerCase()) &&
            input.value != ""
        ) {
            //create li element
            let sIndex =i.toLowerCase().indexOf(input.value.toLowerCase());
            let lIndex = sIndex + input.value.toLowerCase().length;
            let listItem = document.createElement("li");
            //One common class name
            listItem.classList.add("list-items");
            listItem.style.cursor = "pointer";
            listItem.setAttribute("onclick", "displayNames('" + i.trim() + "')");
            //display the value in array
            listItem.innerHTML = i;
            courseIDList.appendChild(listItem);
            if (courseIDList.childNodes.length > 0) {
                courseIDList.style.border = "1px solid #86b7fe";
            }
        }
    }
});

function displayNames(value) {
    input.value = value;
    removeElements();
}

function removeElements() {
    //clear all the item
    let items = document.querySelectorAll(".list-items");
    items.forEach((item) => {
        item.remove();
    });
    courseIDList.style.border = "none";
}

// ============================== for problem Post ===================>



const pblmPostBtn = document.querySelector(".pblm-post"),
pblmPostCancelBtn = document.querySelectorAll(".pblm-post-cancel-btn"),
pblmPostForm = document.querySelector(".problem-post-form");
let coursesPP;
let courseCodesPP =[];

pblmPostBtn.onclick = ()=>{ // -------------- Getting All course's info from database as object.
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/getData.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                coursesPP = JSON.parse(data);
                console.log(data);
                for(let i=0; i<Object.keys(coursesPP).length; i++){
                    courseCodesPP.push(coursesPP[i]["course_title"]+" - "+coursesPP[i]["course_code"]); // taking only course codes
                }
                console.log(coursesPP);
            }
        }
    }
    let Data = "t3t";
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("getCode="+ Data);

    
}


let inputPP = document.getElementById("courseCode1");
const courseIDListPP = document.querySelector(".prob-post-search-list");

pblmPostCancelBtn.forEach(element => {
    element.onclick=()=>{
        courseCodesPP = [];
        pblmPostForm.reset();
        removeElementsPP();
    }
});
//Execute function on keyup
inputPP.addEventListener("keyup", (e) => {


    removeElementsPP(); //Initially remove all elements ( so if user erases a letter or adds new letter then clean previous outputs)
    for (let i of courseCodesPP) {
        //convert input to lowercase and compare with each string

        if (
            i.toLowerCase().includes(inputPP.value.toLowerCase()) &&
            inputPP.value != ""
        ) {
            //create li element
            let listItem = document.createElement("li");
            //One common class name
            listItem.classList.add("list-items");
            listItem.style.cursor = "pointer";
            listItem.setAttribute("onclick", "displayNamesPP('" + i.trim() + "')");
            //display the value in array
            listItem.innerHTML = i;
            courseIDListPP.appendChild(listItem);
            if (courseIDListPP.childNodes.length > 0) {
                courseIDListPP.style.border = "1px solid #86b7fe";
            }
        }
    }
});

function displayNamesPP(value) {
    inputPP.value = value;
    removeElementsPP();
}

function removeElementsPP() {
    //clear all the item
    let items = document.querySelectorAll(".list-items");
    items.forEach((item) => {
        item.remove();
    });
    courseIDListPP.style.border = "none";
}

// ---------------------------------------------------------Problem Post-------------------------------------------------------->




const pblmPostSubmitBtn = document.querySelector(".problem-post-submit-btn");
//  pblmPostForm initialize before... check^

pblmPostForm.onsubmit = (e)=>{
    e.preventDefalut();
}
pblmPostSubmitBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/insert.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data == "success"){
                    location.href = "index.php";
                }
            }
        }
    }
    let formData = new FormData(pblmPostForm);
    formData.append("insertCode","insertProblem");
    xhr.send(formData);
}


// ---------------------------------------------------------All post fetch-------------------------------------------------------->


const allPostContainer = document.querySelector(".user_activity .activity-posts");


let pblmPostsLength = -1;

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
                if(pblmPostsLength != ppNums){
                    allPostContainer.innerHTML = dataSplit[1];
                    pblmPostsLength = ppNums;
                    postTabLink();
                    
                }
            }
        }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("getCode=getActivityPosts");




},1000);

const pendingPostContainer = document.querySelector(".user_activity .pending-posts");


let pendingPostsLength = -1;

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
                if(pendingPostsLength != ppNums){
                    pendingPostContainer.innerHTML = dataSplit[1];
                    pendingPostsLength = ppNums;
                    postTabLink();

                }
            }
        }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("getCode=getPendingPosts");




},1000);

const solvedPostContainer = document.querySelector(".user_activity .solved-posts");


let solvedPostsLength = -1;

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
                if(solvedPostsLength != ppNums){
                    solvedPostContainer.innerHTML = dataSplit[1];
                    solvedPostsLength = ppNums;
                    postTabLink();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("getCode=getSolvedPosts");




},1000);




// ========================= Normal Design Codes ===============================>


function postTabLink(){
    const pPostTab = document.querySelectorAll(".user_dashboard .user_activity .card");


    pPostTab.forEach(element => {
        element.onclick = ()=>{
            console.log("clicked");
            const pblmId = element.querySelector(".pblm_id").innerHTML;
            location.href = "problem_panel.php?post_id="+pblmId+"&view=true";
        }
    });
}