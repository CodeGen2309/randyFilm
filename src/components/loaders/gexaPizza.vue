<script></script>



<template>
  <div class="gexaPizza"></div>
</template>


<style scoped>
.gexaPizza {
  width: 60px;
  aspect-ratio: 1.154;
  color: #25b09b;
  display: grid;
  animation: l38-0 6s infinite linear;
}
.gexaPizza:before,
.gexaPizza:after {
  content: "";
  grid-area: 1/1;
}
.gexaPizza:before {
  clip-path: polygon(25% 0,75% 0,100% 50%,75% 100%,25% 100%,0 50%);
  background: conic-gradient(from -30deg,#0000 60deg,currentColor 0);
}
.gexaPizza:after {
  background: conic-gradient(from -30deg,currentColor 60deg,#0000 0);
  animation: l38 0.5s infinite alternate;
}
@keyframes l38-0 {
  0%,16.66%     {transform: rotate(0deg)}
  16.67%,33.33% {transform: rotate(60deg)}
  33.34%,50%    {transform: rotate(120deg)}
  50.1%,66.66%  {transform: rotate(180deg)}
  66.67%,83.33% {transform: rotate(240deg)}
  83.34%,100%   {transform: rotate(300deg)}
}
@keyframes l38 {
  100%  {transform: translateY(-20px)}
}

</style>
