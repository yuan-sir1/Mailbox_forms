function getQueryParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

window.onload = function () {
    const reason = getQueryParameter('reason') || '未知原因';
    document.getElementById('error-reason').innerText = decodeURIComponent(reason);
}