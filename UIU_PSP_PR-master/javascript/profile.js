const updateInfoBtn = document.querySelector(".update-user-info-btn"),
updateInfoForm= document.querySelector(".update-user-info-form");

updateInfoForm.onload = (e)=>{
    e.preventDefault();
}

updateInfoBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data == "success"){
                    location.href = "profile.php";
                }else if(data == "successLog"){
                    location.href = "login.php";
                }
            }
        }
    }
    let formData = new FormData(updateInfoForm);
    formData.append("updateCode", "updateProfile");
    xhr.send(formData);
}


// -------------------------------------- keyup suggestion -------------------------------------

const addCourseBtn = document.querySelector(".add-course-btn"),
addCourseCancelBtn = document.querySelector(".add-course-cancel-btn");
takenCourseForm = document.querySelector(".course-submit-form");
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


let input = document.getElementById("courseId");
const courseIDList = document.querySelector(".CCcourse-search-list");



addCourseCancelBtn.onclick=()=>{
    courseCodes = [];
    takenCourseForm.reset();
    removeElements();
}
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



const pblmPostBtn = document.querySelector(".ques-upload-btn"),
pblmPostCancelBtn = document.querySelectorAll(".ques-upload-cancel-btn"),
pblmPostForm = document.querySelector(".quesionUploadFrom");
let coursesPP;
let courseCodesPP =[];
// console.log(pblmPostBtn);

pblmPostBtn.onclick = ()=>{ // -------------- Getting All course's info from database as object.
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/getData.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                coursesPP = JSON.parse(data);
                // console.log(data);
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


let inputPP = document.getElementById("courseCode");
const courseIDListPP = document.querySelector(".pp-course-search-list");

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



// ------------------------ inserting taken courses in database -------------------------------



const courseSubmitBtn = document.querySelector(".course-submit-btn"),
courseSubmitForm = document.querySelector(".course-submit-form");


courseSubmitForm.onload = (e)=>{
    e.preventDefault();
}
courseSubmitBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                location.href = "profile.php";
            }
        }
    }
    let formData = new FormData(courseSubmitForm);
    formData.append("insertCode","takenCourse");
    xhr.send(formData);
}


// ====================================Question paper upload ===============================================>



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
                    location.href = "profile.php";
                }
            }
        }
    }
    let formData = new FormData(quesionUploadFrom);
    formData.append("insertCode", "insertQP");
    xhr.send(formData);
}



// ============================= Normal design codes ========================>


const courseViewBtn = document.querySelectorAll(".course_container .card-header");

courseViewBtn.forEach(element => {
    element.onclick = ()=>{
        let i = element.querySelector(".view-qp i");
        if(i.classList.contains("fa-angle-down")){
            i.classList.remove("fa-angle-down");
            i.classList.add("fa-angle-up");
        }else{
            i.classList.remove("fa-angle-up");
            i.classList.add("fa-angle-down");
        }
    }
});



// --------progress -------------->

const progressBar = document.querySelectorAll(".p-circular-progress");
const valueContainer = document.querySelectorAll(".p-value-container");
let colors = ["#4d5bf9","#219ebc","#ff595e","#ff6a00"];
progressBar.forEach((element,i) => {
    let containerValue = parseInt(valueContainer[i].innerHTML);
    let init = 0;
    let Cspeed = 1000/containerValue;

    let Cprogress = setInterval(() => {

        if(init>9){
            valueContainer[i].textContent = `${init}`;
        }else{
            valueContainer[i].textContent = `0${init}`;
        }

        if (init == containerValue) {
            clearInterval(Cprogress);
        }
        init++;
    }, Cspeed);


    let progressValue = 0;
    let progressEndValue = 100;
    let speed = 10;
    let progress = setInterval(() => {
        progressValue++;
        progressBar[i].style.background = `conic-gradient(
              ${colors[i]} ${progressValue * 3.6}deg,
              #cadcff ${progressValue * 3.6}deg
        )`;
        if (progressValue == progressEndValue) {
            clearInterval(progress);
        }
    }, speed);
});
//#4d5bf9 #cadcff




// =================== tooltips code ===============>

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })