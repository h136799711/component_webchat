# component_webchat
webchat base on workerman-chat

WebSocket Server

1. register service listen on 7272
2. gateway service listen on 17272 and local port 17280 17281 17282 17283


JSON Protocol
1. Request Packet 
    msg_type, content, req_id
2. Response Packet
    msg_type, content, req_id
    
Special Business Packet
1. Login Packet
    msg_type: login
    req   
    content : nick, uid, avatar
    resp  
    content : uid, client_id, online
     
2. Logout
    msg_type: logout
    req   
    content : uid
    resp  
    content
3. Message
    msg_type: msg_0
    req
    content : uid, client_id
    resp  
    content
    
