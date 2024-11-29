const addModalowner = document.getElementById('add-owner-modal');
const viewModalowner = document.getElementById('view-owner-modal');

const btnAddowner = document.querySelector('.btn-add-owner')
const btnCancelModal = document.querySelector('.owner-cancel-btn');
const btnViewowner = document.querySelectorAll('.view-owner-btn');
const btnCloseModal = document.querySelector('.close-owner-modal');


// ADD NEW owner MODAL EVENT LISTENER
btnAddowner.addEventListener('click', (e)=>{
   addModalowner.classList.add('displayAddownerModal');
});

btnCancelModal.addEventListener('click', (e)=>{

   addModalowner.classList.remove('displayAddownerModal');

});


// VIEW owner INFO MODAL EVENT LISTERNER
for(let i = 0; i < btnViewowner.length; i++){
   
   btnViewowner[i].addEventListener('click', (e)=>{
      viewModalowner.classList.add('displayViewownerModal');
   });
}


// btnCloseModal.addEventListener('click', (e) =>{
//    viewModalowner.classList.remove('displayViewownerModal');
// })

