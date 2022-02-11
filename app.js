const $editor = document.getElementById('editor');
if($editor instanceof HTMLElement){
    BalloonEditor.create($editor, {
        ckfinder:{
            uploadUrl: '/image/upload.php'
        }
    }).then(editor => {
        editor.editing.view.focus();//페이지 로딩시 커서 자동 포커스
        const $form = document.querySelector('#main__form-post > form');
        $form.addEventListener('submit', e =>{
            const data = document.createTextNode(editor.getData());
            document.querySelector('#main__form-post textarea[name=content]').appendChild(data);
        });
    });
}

//readmore 처리
const $readmore = document.getElementById('readmore');
if($readmore instanceof HTMLElement){
    let page = 0;
    //버튼 클릭 이벤트처리
    $readmore.addEventListener('click', ()=> {
        //fetch는 ajax 요청을 처리할 수 있다.
        fetch('/?page=' + ++page, {method: 'get'}).then(async response => {
            console.log("click");
            //console.log(await response.text()); //response에는 어떤 데이터로 반환되어오는지 확인
            //response는 HTML 형식으로 반환되므로 이 처리를 해주어야 한다. DOMParser();
            const parser = new DOMParser();
            const doc = parser.parseFromString(await response.text(), 'text/html');
            const list = doc.querySelectorAll('.uk-container > .uk-list > li');
            if(list.length > 0 ){
                Array.from(list).forEach(item => {
                    document.querySelector('.uk-container').appendChild(item);
                });
            }
        });
    });
}