document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nameInput = document.getElementById("name");
    const subjectInput = document.getElementById("subject");
    const messageInput = document.getElementById("message");

    form.addEventListener("submit", function (event) {
        // 验证文本输入框
        const textInputs = [nameInput, subjectInput, messageInput];
        const regex = /^[^<>]*$/; // 允许的字符：禁止 < 和 >

        for (const input of textInputs) {
            if (!regex.test(input.value)) {
                alert("请勿输入特殊字符！");
                event.preventDefault();
                location.reload(); // 刷新页面
                return;
            }
        }

        // 验证邮箱格式
        const emailInput = document.getElementById("email");
        const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
        if (!emailPattern.test(emailInput.value)) {
            alert("请输入有效的邮箱地址！");
            event.preventDefault();
            location.reload(); // 刷新页面
        }
    });
});