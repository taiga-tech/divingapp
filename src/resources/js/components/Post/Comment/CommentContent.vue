<template>
<div class="d-flex justify-content-between border-bottom p-2">
<div class="d-flex">
    <div class="mr-2">
      <img src="/default.png" class="rounded-circle border text-center" style="width: 40px; height: 40px">
    </div>
    <div>
      <div class="d-flex">
        <p>profilename</p>
        <p class="ml-1 opa">@username</p>
        <p class="ml-1 opa">・1分前<!-- {{ comment.created_at | moment }} --></p>
      </div>
      <div class="textArea mt-1">{{ comment }}</div>
    </div>
  </div>
  <div>
    <i class="fas fa-ellipsis-h"></i>
  </div>
</div>
</template>

<script>
import moment from 'moment';

export default {
  props: {
    comment: Object,
  },
  filters: {
    moment: function (data) {
      moment.locale('ja')
      return moment(data).fromNow()
    }
  },
}
</script>
