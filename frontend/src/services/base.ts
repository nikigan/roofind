import axios from "axios";

const instance = axios.create({
    baseURL: process.env.API_URL || "http://building.loc/api",
});

export default instance;
