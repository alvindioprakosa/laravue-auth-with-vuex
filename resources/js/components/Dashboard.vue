<template>
  <div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Dashboard</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Dashboard Information.</p>
      </div>

      <div class="border-t border-gray-200">
        <dl v-if="user">
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Name</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ user.name }}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Email</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ user.email }}</dd>
          </div>
        </dl>
      </div>

      <div class="p-4">
        <button
          @click.prevent="logout"
          class="w-full px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-red-600 bg-white hover:bg-red-50"
        >
          Logout
        </button>
      </div>
    </div>

    <!-- Subject List -->
    <div class="mt-6">
      <h4 class="text-md font-semibold mb-2">Subjects:</h4>
      <ul v-if="getAllSubjects && getAllSubjects.length">
        <li
          v-for="(item, index) in getAllSubjects"
          :key="item.id"
          class="text-gray-800"
        >
          {{ index + 1 }}. {{ item.name }}
        </li>
      </ul>
      <p v-else class="text-gray-400">No subjects available.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      user: null,
    };
  },
  created() {
    // Set default headers untuk semua request axios
    axios.defaults.headers.common['Content-Type'] = 'application/json';
    axios.defaults.headers.common['Authorization'] =
      'Bearer ' + localStorage.getItem('token');

    // Ambil data user login
    axios
      .get('api/user')
      .then((response) => {
        this.user = response.data;
      })
      .catch((error) => {
        console.error(error);
        this.$router.push('/login');
      });
  },
  mounted() {
    // Dispatch action untuk mengambil data subject dari backend
    this.$store.dispatch('subject/allsubjectFromDatabase');
  },
  computed: {
    ...mapGetters({
      getAllSubjects: 'subject/getSubject',
    }),
  },
  methods: {
    logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      this.$router.push('/login');
    },
  },
};
</script>

<style scoped>
/* Optional styling here */
</style>
