$.get("check-session.php", function (data, status) {
    var obj=JSON.parse(data);

    if(obj.username==null)
    {   alert("Actiune interzisa, te rugam sa te loghezi");
        window.location.href = 'main.html';
    }
});