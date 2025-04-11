<template>
  <div class="flex flex-wrap w-full justify-center items-center pt-10">
    <div class="flex flex-wrap max-w-xl w-full bg-white shadow-md rounded-md p-6">
      <div class="w-full mb-4 text-center">
        <h1 class="text-2xl font-semibold text-gray-800">Login to your account</h1>
        <p class="text-sm text-gray-500">Please enter your credentials below.</p>
      </div>

      <!-- Error message -->
      <div v-if="error" class="w-full mb-3">
        <p class="text-red-600 text-sm bg-red-100 p-2 rounded">{{ error }}</p>
      </div>

      <div class="w-full mb-4">
        <label for="email" class="block text-gray-700 mb-1">Your e-mail</label>
        <input
          id="email"
          type="email"
          v-model="form.email"
          class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 px-4 py-2"
          placeholder="Email"
        />
      </div>

      <div class="w-full mb-4">
        <label for="password" class="block text-gray-700 mb-1">Password</label>
        <input
          id="password"
          type="password"
          v-model="form.password"
          class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 px-4 py-2"
          placeholder="Password"
        />
      </div>

      <div class="w-full mt-2">
        <button
          @click.prevent="login"
          class="w-full text-white bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded text-lg font-medium transition duration-150"
        >
          Login
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      error: null,
    };
  },
  methods: {
    async login() {
      this.error = null;

      if (!this.form.email || !this.form.password) {
        this.error = "Please fill in both email and password.";
        return;
      }

      try {
        const response = await axios.post("api/login", this.form);
        const data = response.data;

        localStorage.setItem("token", data.token);
        this.$router.push({ name: "dashboard" });
      } catch (err) {
        if (err.response && err.response.data) {
          this.error =
            err.response.data.error ||
            err.response.data.message ||
            "Login failed.";
        } else {
          this.error = "Network error or server not reachable.";
        }
      }
    },
  },
};
</script>
