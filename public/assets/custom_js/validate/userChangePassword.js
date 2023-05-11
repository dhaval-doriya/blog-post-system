$("#regFormPart1").validate({
    username: {
        required: true,
        minlength: 8,
        uniqueUserName: true
    },
    messages: {
        username: {
            required: "Username is required",
            minlength: "Username must be at least 8 characters",
            uniqueUserName: "This Username is taken already"
        }
    }
});
