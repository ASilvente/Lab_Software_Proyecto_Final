function doSomething() {
    var myUserCookie = getCookie("usr_ck");
    var myFlyingCookie = getCookie("aero_ck");

    if (myUserCookie == null && myFlyingCookie == null) {
        // do cookie doesn't exist stuff;
    }
    else if (myUserCookie != null && myFlyingCookie == null){
        // do cookie exists stuff
    }
    else if (myFlyingCookie != null && myUserCookie == null){
        // do cookie exists stuff
    } else{
        //do none of the cookies exist
    }
}