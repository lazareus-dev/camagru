const submitBtn = document.getElementById('submitCmt');
const cmtArea = document.getElementById('cmt_area');

function validateForm() {
    if (!cmtArea.value || cmtArea.value === "")
    {
        cmtArea.focus();
        return false;
    }
}

submitBtn.addEventListener('click', () => {
    validateForm();
});