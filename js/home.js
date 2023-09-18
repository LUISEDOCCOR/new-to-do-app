let form = document.getElementById('new_todo')
form.addEventListener('submit', verify)

function verify(e){
    let title = document.getElementById('title').value
    let des = document.getElementById('des').value
    const alert = document.getElementById('alert')

    if(title == '' || des == ''){
        alert.classList.remove('d-none')
        e.preventDefault()
        alert.innerText  = 'fill out all the fields'
    }else{
        alert.classList.add('d-none') 
    }
}
