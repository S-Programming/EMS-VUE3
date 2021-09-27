import EventEmitter from 'events';
import axios from "axios";

class AuthService extends EventEmitter{
     async handleLogin(email, password) {
      let credentials = {email,password};
      console.log(credentials,"credentials");
         // const rawResponse = await fetch('/login', {
         //     method: 'POST',
         //     headers: {
         //         'Accept': 'application/json',
         //         'Content-Type': 'application/json'
         //     },
         //     body: JSON.stringify(credentials)
         // });
         // console.log(rawResponse,'rawResponse');
       let response = await axios.post('/login',credentials)
            .then(data => {
                console.log(data,'data');
                // this.onLogin(data.data.login.access_token,
                //     data.data.login.expires_in, data.data.login.user, rememberMe)
            })
            .catch(error => {
                console.log(error,"error catch")
                // this.emit(loginEvent, {
                //     loggedIn: false,
                //     errorType: errorType,
                //     errorMessage: errorMessage
                // });
            });
    }
    // async onLogin(token, expires_in, profile, rememberMe) {
    //     if (apolloClient.wsClient) {
    //         restartWebsockets(apolloClient.wsClient);
    //     }
    //     try {
    //         const accessTokenExpiry = moment().add(expires_in, 's');
    //         await apolloClient.resetStore();
    //         const accessToken = JSON.stringify(token);
    //         await store.dispatch('setAuthState',
    //             {profile, token, accessTokenExpiry});
    //         localStorage.setItem(AUTH_TOKEN, token);
    //         localStorage.setItem(localStorageKey, "true");
    //         this.emit(loginEvent, {
    //             loggedIn: true,
    //         });
    //     } catch (e) {
    //         if (!this.isUnauthorizedError(e)) {
    //             console.log('%cError on cache reset (login)', 'color: orange;',
    //                 e.message)
    //         }
    //     }
    // }
}
const service = new AuthService();
export default service;
