<template>
  <app-layout>
    <template #header>
      <h2 class="fonmt-semibold text-xl text-gray-800 leading-tight">
        Projects
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <jet-button
          class="
            p-3
            border-2 border-blue-500
            text-blue-500
            bg-blue-50
            hover:bg-blue-200
            mr-2
          "
          @click="
            showModal = true;
            method = 'post';
            action = route('projects.store');
          "
          >Add New +</jet-button
        >
        <jet-modal :show="showModal" closeable="true" @close="showModal = null">
          <div class="bg-gray-50 shadow-2xl p-6 mx-10">
            <form
              @submit.prevent="submit"
              class="flex flex-col itemrs-center p-16"
            >
              <jet-input
                class="px-5 py-3 w-96 border border-gray-600 rounded ml-4 mb-5"
                type="text"
                name="title"
                placeholder="Project Title"
                v-model="form.title"
              ></jet-input>
              <jet-input-error :message="form.errors.title" />

              <jet-input
                class="px-5 py-3 w-96 border border-gray-600 rounded ml-4"
                type="text"
                name="description"
                placeholder="Project Description"
                v-model="form.description"
              ></jet-input>
              <jet-input-error :message="form.errors.description" />

              <select
                class="w-96 border border-gray-600 rounded mt-5 ml-4"
                v-model="form.color"
              >
                <option value="">Select a color</option>
                <option v-for="color in colors" :value="color">
                  {{ color }}
                </option>
              </select>

              <select
                class="w-96 border border-gray-600 rounded mt-5 ml-4"
                v-model="form.icon_name"
              >
                <option value="">Select an icon</option>
                <option v-for="icon in icons" :value="icon">
                  {{ icon }}
                </option>
              </select>
              <jet-input-error :message="form.errors.icon" />
              <!-- form property declared in data() -->

              <jet-button
                class="
                  px-5
                  py-3
                  mt-5
                  w-96
                  bg-purple-400
                  justify-center
                  rounded-xl
                  text-sm
                  ml-4
                "
                :disabled="form.processing"
                ><span class="animate-spin mr-1" v-show="form.processing"
                  >&#9696;</span
                >

                <span v-show="!form.processing">Submit Skill</span>
              </jet-button>
            </form>
          </div>
        </jet-modal>
        <table v-if="projects.length > 0" class="w-full text-left">
          <thead class="border-b-2 border-gray-300 text-indigo-600">
            <tr>
              <th class="px-6 py-3 text-left">Title</th>
              <th class="px-6 py-3 text-left">Description</th>
              <th class="px-6 py-3 text-left">Color</th>
              <th class="px-6 py-3 text-left">Icon</th>
              <th class="px-6 py-3 text-left">Actions</th>
            </tr>
          </thead>
          <tbody v-for="(project, index) in projects">
            <tr class="text-sm text-indigo-900 border-b border-gray-400">
              <td class="px-6 py-4">{{ project.title }}</td>
              <td class="px-6 py-4">{{ project.description }}</td>
              <td class="px-6 py-4">
                <p class="mr-8">
                  <span class="mr-5 p-4 rounded" :class="project.color">{{
                    project.color
                  }}</span>
                </p>
              </td>
              <td class="px-4 py-4" :class="project.color">
                <component :is="componentName(index)"></component>
              </td>
              <td class="px-6 py-4">
                <jet-button
                  class="
                    border border-indigo-500
                    text-indigo-500
                    bg-indigo-50
                    hover:bg-indigo-100
                    mr-2
                  "
                  @click="
                    showModal = true;
                    method = 'put';
                    action = route('projects.update', [project.id]);
                    form.title = project.title;
                    form.description = project.description;
                    form.color = form.color;
                    form.icon_name = form.icon_name;
                  "
                  >Edit</jet-button
                >
                <jet-button
                  class="
                    border border-red-500
                    text-red-500
                    bg-red-50
                    hover:bg-red-100
                    mr-2
                  "
                  >Delete</jet-button
                >
              </td>
            </tr>
          </tbody>
        </table>
        <div
          v-else
          class="bg-red-100 border border-red-400 p-3 rounded-lg text-red-800"
        >
          There are no projects yet. Create one!
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineAsyncComponent, defineComponent } from "vue";

import AppLayout from "@/Layouts/AppLayout";

import JetButton from "@/Jetstream/Button";
import JetModal from "@/Jetstream/Modal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";

export default defineComponent({
  components: {
    AppLayout,
    JetButton,
    JetModal,
    JetInput,
    JetInputError,
  },

  props: {
    projects: Object,
    icons: Object,
    colors: Object,
  },

  methods: {
    componentName(index) {
      // async components let us create a component in real time so we can see something while the async component is loading
      return defineAsyncComponent(() =>
        import(
          "@heroicons/vue/solid/" + this.projects[index].icon_name + "Icon.js"
        )
      );
    },
    submit() {
      // submit a post request to the skills route and the store method in the controller
      this.form.submit(this.method, this.action, {
        onSuccess: () => {
          //   on form submit reset the fields
          this.form.reset("title");
          this.form.reset("description");
          this.form.reset("color");
          this.form.reset("icon_name");
          this.showModal = null;
        },
      });
    },
  },

  data() {
    return {
      showModal: null,
      method: null,
      action: null,
      form: this.$inertia.form({
        title: "",
        description: "",
        color: "",
        icon_name: "",
      }),
    };
  },
});
</script>