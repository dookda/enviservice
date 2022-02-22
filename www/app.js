const d = new Date();
let year = d.getFullYear();
document.getElementById("year").innerText = year;
console.log(year);


let quest = [5, 6, 7, 8, 9];

quest.map(i => {
    let tagetDiv = document.getElementById("quest")
    let lstQuest = `<div class="shadow-none p-3 mb-1 bg-light rounded flex" role="alert">
สอบถาม คำถาม ปัญหา <button class="btn btn-info" style="margin-left: auto;">รายละเอียด</button>
</div>`;

    tagetDiv.innerHTML += lstQuest;
})