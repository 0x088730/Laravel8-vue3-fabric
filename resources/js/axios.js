import axios from "axios"
import { endpoint } from "./config/api"

const token = document.head.querySelector('meta[name="csrf-token"]') ?? null

const axiosInstance = axios.create({
  baseURL: endpoint,
  // timeout: 1000,
  withCredentials: true,
  headers: {
    "X-CSRF-TOKEN": token.content,
  }
})

export default axiosInstance
