import { convertNodesToArray } from '../helpers/helpers';
const features = () => {

    const features = convertNodesToArray('.btn-features');

    const initFeature = featureWrapper => {
        featureWrapper.onclick = function () {

            this.classList.toggle('active');
            let next = this.nextElementSibling;
            if (this.classList.contains('active')){
                this.innerHTML = this.getAttribute('data-name-closed');
                next.classList.add('features-list-open');
            } else {
                this.innerHTML = this.getAttribute('data-name-open');
                next.classList.remove('features-list-open');
            }
        };
    };

    features.forEach(initFeature);

};

export default features;