import {ref} from "vue";
import authService from "../services/authService";
export const authLogin = (props) => {
    const email = ref('');
    const password = ref('');

    const handleLogin = () => {
        authService.handleLogin(email.value, password.value);
    }
    return {
        email,
        password,
        handleLogin
    }
}
export default {authLogin}
