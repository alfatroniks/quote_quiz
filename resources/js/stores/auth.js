import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        //todo ? need localstorage
    }),
    actions: {
        async login(email, password) {
            try {
                await axios.get('/sanctum/csrf-cookie');
                const response = await axios.post('/login', { email, password });
                await this.checkUser();
                // console.log(getUser);
                // this.user = getUser.data.user;
                return true;
            } catch (error) {
                throw new Error('Auth Error');
            }
        },
        async checkUser() {
            try {
                const response = await axios.get('/user');
                this.user = response.data;
            } catch (error) {
                this.user = null;
            }
        },
        async logout() {
            await axios.post('/logout');
            this.user = null;
            // localStorage.removeItem('token');
            // axios.defaults.headers.common['Authorization'] = 'Bearer';
        }
    }
});
