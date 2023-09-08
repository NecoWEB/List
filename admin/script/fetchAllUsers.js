const fetchUsers = async () => {
    try {
      const response = await fetch("config/fetch-all-users.php/", {
        method: "GET",
        headers: {
          Accept: "application/json",
        },
      });
      const data = await response.json();
      //console.log(data);
      let users = "";
      for (let user in data) {
        users += `
                  <div class="user-admin">
                      <div class="user-data">
                          <h4>${data[user].id_customer}</h4>
                          <p class="usr-name">Email: ${data[user].email}</p>
                          <p class="usr-ban">Banned: ${data[user].banned}</p>
                      </div> `; 
                      
                      if(data[user].banned != 1) {
                        users += `
                      <div class="admin-usr-actions d-flex justify-content-center">
                          <button id="banUser" onclick="banUser(${data[user].id_customer})" type="button" class="btn btn-danger">Ban user</button>
                      </div>
                      `;
                      }
                      users += `<hr>
                      </div>`
      }
  
      document.querySelector(".users").innerHTML = users;
    } catch (e) {
      console.log("Fetch error" + e);
    }
};
let banUser = (param) => {
    location.href= `./config/ban-user.php?id_customer=${param}`;
};