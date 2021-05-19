import mixins from './mixins/index.js'

import {
  Bar,
} from './BaseCharts'

const VueCharts = {
  Bar,
  render: () => console.error('[vue-chartjs]: This is not a vue component. It is the whole object containing all vue components. Please import the named export or access the components over the dot notation. For more info visit https://vue-chartjs.org/#/home?id=quick-start')
}

export default VueCharts

export {
  VueCharts,
  Bar,
}
