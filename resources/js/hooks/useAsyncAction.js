import { ref } from "vue";
import { useStore } from "vuex";

export default function useAsyncAction(action) {
  const store = useStore();

  const isLoading = ref(false);

  const callAction = (
    payload,
    errorMessage = "Error when dispatching action",
  ) => {
    isLoading.value = true;
    return store
      .dispatch(action, payload)
      .then((data) => {
        return data;
      })
      .catch((error) => {
        console.log('fail:', errorMessage);
        return Promise.reject(error);
      })
      .finally(() => {
        isLoading.value = false;
      });
  };

  return {
    callAction,
    isLoading,
  };
}
