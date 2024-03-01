const optionNodeList = document.querySelectorAll('.form-floating select.form-select > option');
const optionList = [...optionNodeList];
console.log(optionList);


optionList.forEach(option => {
    option.addEventListener('hover', function () {
        console.log(this);

        this.style.backgroundColor = 'red';
        this.style.color = 'green';
    })
});
