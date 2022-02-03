const xavier = document.getElementById("xavier")
const cv = document.getElementById("cv")

xavier.addEventListener('mouseover', () => {
    cv.classList.remove('d-none')
    xavier.classList.remove('d-block')
    cv.classList.add('d-block')
    xavier.classList.add('d-none')
});
cv.addEventListener('mouseout', () => {
    cv.classList.remove('d-block')
    xavier.classList.remove('d-none')
    cv.classList.add('d-none')
    xavier.classList.add('d-block')
});