<template>
  <div class="p-2">
    <button :disabled="disabled" class="btn btn-primary" type="button">
      <template v-if="!loading">
        <slot>
          {{ label }}
        </slot>
      </template>
      <template v-else>
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
        ></span>
        Loading...
      </template>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    disabled: { type: Boolean, default: false },
    label: { type: String },
    loading: { type: Boolean, default: false },
  },
};
</script>
<style></style>
