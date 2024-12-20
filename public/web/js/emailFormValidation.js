// 校验邮箱格式的函数
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// 提交表单时进行校验
document.getElementById("emailForm").addEventListener("submit", function (event) {
    // 检查是否所有字段都已填写
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;

    if (!name || !validateEmail(email) || !subject || !message) {
        alert("请填写完整信息并检查邮箱格式后再提交！");
        event.preventDefault(); // 阻止表单提交
    }
});

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
    });
});