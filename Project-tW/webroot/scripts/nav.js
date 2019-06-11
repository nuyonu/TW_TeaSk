function nav(max) {
    max = parseInt(max);
    var node = document.getElementById('inp');
    if (node.value < 1) {
        node.value = 1;
    }
    if (node.value > max) {
        node.value = max;
    }
    node.value = Math.trunc(node.value);
    document.getElementById('paged').href = "/adminUsers?page=" + node.value;

}