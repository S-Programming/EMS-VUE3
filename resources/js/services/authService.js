import EventEmitter from 'events';
import axios from "axios";
import store from "../store";

const localStorageKey = "loggedIn";

class AuthService extends EventEmitter{
     async handleLogin(email, password) {
      let credentials = {email,password};
       let response = await axios.post('/login',credentials)
            .then(data => {
               if(data.status == 200){
                   this.onLogin(data.data.token,data.data.user_data);
                   this.emit('loginSuccess',data);
               }
            })
            .catch(error => {
                console.log(error,"error catch")
            });
    }
    async onLogin(token, profile) {
        try {
            await store.dispatch('setAuthState', {profile, token});
            localStorage.setItem(localStorageKey, "true");
        } catch (e) {
                console.log('Error on cache reset (login)', e.message)
        }
    }
}
const service = new AuthService();
export default service;
