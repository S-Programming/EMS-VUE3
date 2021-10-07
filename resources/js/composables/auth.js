import {ref} from "vue";
import authService from "../services/authService";
import {ApiResonse} from "../constants";
import {useRouter} from "vue-router";

export const authLogin = (props) => {
    const email = ref('');
    const password = ref('');
    const router = useRouter();
    const handleLogin = () => {
        authService.handleLogin(email.value, password.value);
    }
    authService.addListener('loginSuccess',(data)=>{
        if(data.status === ApiResonse.SUCCESS_CODE){
            router.push({
                path: `/v/dashboard`
            });
        }
    })
    return {
        email,
        password,
        handleLogin
    }
}
export default {authLogin}
