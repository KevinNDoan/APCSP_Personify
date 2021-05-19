

/*! Serve Messages
 * One parameter: timestamp
 * timestamp: onload, the timestamp is 0 (because the serve hasn't sent one yet). After our function is run for the first time
 *            the server will send back the timestamp of the latest message. This new timestamp will into the function (so that the server can receive it).
 -----------------------------------------------------------
 * 1. Fetch data (data is going to be in JSON)
 * 2. Parse out: username, message, type, timestamp
 * 3. Decide if the username is you or someone else
 * 4. Display the messages with that information
 * 5. Run the function again (the function will loop forever)
*/
(async function serveMessages(timestamp) {
    if(timestamp == undefined){
        timestamp = 0;
    }
    let poll = await fetch("https://personify.us.to/backend/requestMessages?timestamp=" + timestamp);
    if(poll.status == 502){
        console.log('There was an error.');
        return;
    } else if(poll.status != 200) {
        console.log('There was an error.');
        return;
    } else {
        $.get('https://personify.us.to/backend/messages.json')
            .done(data=> {
                $('#msg-area').html('');
                for(var i = 0;i < data.messages.length;i++){
                    var sender = data.messages[i].username;
                    var message = data.messages[i].message;
                    var newTimestamp = data.messages[i].timestamp;
                    var type = data.messages[i].type;

                    if(type == "text"){
                        if(sender == user){
                            if (message.search("https://") != -1){
                                $('#msg-area').append(`<div class="msg-sent">
                                    <div class="bg-primary msg-sent-content">
                                        <a class="text-white" href="` + message + `">` + message + `</a>
                                    </div>
                                </div>
                                <br>`);
                            } else {
                                $('#msg-area').append(`<div class="msg-sent">
                                    <div class="bg-primary msg-sent-content">
                                        ` + message + `
                                    </div>
                                </div>
                                <br>`);
                            }
                        } else {
                            // Hyperlinking Links
                            if (message.search("https://") != -1 ){
                                $('#msg-area').append(`<div class="msg-received-sender">
                                    <div class="bg-secondary msg-received-content">
                                        <a class="text-white" href="` + message + `">` + message + `</a>
                                    </div>
                                    <br>
                                    <small class="ms-1 text-muted">` + sender + `</small>
                                </div>
                                <br>`);
                            } else {
                                $('#msg-area').append(`<div class="msg-received-sender">
                                    <div class="bg-secondary msg-received-content">
                                        ` + message + `
                                    </div>
                                    <br>
                                    <small class="ms-1 text-muted">` + sender + `</small>
                                </div>
                                <br>`);
                            }
                        }
                    } else if(type == "image") {
                        if(sender == user){
                            $('#msg-area').append(`<div class="msg-sent">
                                <div class="msg-sent-img">
                                    <img style="max-width:30%;border-radius:10px;" src="https://personify.us.to/` + message + `">
                                </div>
                            </div>
                            <br>`);
                        } else {
                            $('#msg-area').append(`<div class="msg-received-sender">
                                <div class="msg-received-img">
                                    <img style="max-width:30%;border-radius:10px;" src="https://personify.us.to/` + message + `">
                                </div>
                                <br>
                                <small class="ms-1 text-muted">` + sender + `</small>
                            </div>
                            <br>`);
                        }
                    }
                    timestamp = newTimestamp;
                }
                console.log(timestamp);
                
                window.scrollTo(0,document.getElementById('msg-area').scrollHeight);
                serveMessages(timestamp);
            })
    }
})();

/*! Send messages
 * One parameter: user
 * user: the username. This will be used to identify the user as the sender of a message
 -----------------------------------------------------------
 * 1. Grab message from the input box
 * 2. Send message and user through a get request
 * 3. Clear the input box so that the user can type in another message (<---- Youssef could you add this)
*/
async function sendMessages (user){ 
    var text = document.getElementById("input").value;
    var  xmlHttp = new XMLHttpRequest();
  
    xmlHttp.open ("GET","https://personify.us.to/backend/sendMessages?message=" + text + "&sender=" + user, true);
    xmlHttp.send();
    document.getElementById("input").value = "";
}

/* Sign out
 * No parameters
 -----------------------------------------------------------
 * Redirects user to sign out PHP script.
 * Script Location: http://personify.us.to/signout
*/
function signout() {
    window.location.href = "https://personify.us.to/signout";
}