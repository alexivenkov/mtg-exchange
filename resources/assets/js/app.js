require('./bootstrap');

class App {
    constructor() {
        Echo.channel('mtg')
            .listen('UserAddCard', (e) => {
                console.log(e);
            });
    }
}

$(() => {
    new App();
});
