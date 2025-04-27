import { defineStore } from "pinia";
import axios from "axios";

export const useSystemStore = defineStore("system", {
    state: () => ({
        loading: false, // Loading state
        error: null, // Error state
        user: null, // User data
    }),
    getters: {
        getUser(state) {
            return state.user;
        },
        isLoading(state) {
            return state.loading;
        },
        getError(state) {
            return state.error;
        }
    },
    actions: {
        setLoading(value) {
            this.loading = value;
        },
        setError(value) {
            this.error = value;
        },
        setUser(value) {
            this.user = value;
        },
    },
});
