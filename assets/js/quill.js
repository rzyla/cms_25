document.addEventListener('DOMContentLoaded', function () 
{
  	if (typeof Quill === 'undefined') 
	{
    	console.error('Quill not found. Load quill.js before this script.');
    	return;
  	}

	const toolbarContainer = 
	[
    	[{ font: [] }],
    	[{ size: ['small', false, 'large', 'huge'] }],
    	['bold', 'italic', 'underline', 'strike'],
    	[{ color: [] }, { background: [] }],
    	[{ script: 'sub' }, { script: 'super' }],
    	[{ header: 1 }, { header: 2 }],
    	[{ list: 'ordered' }, { list: 'bullet' }],
    	[{ indent: '-1' }, { indent: '+1' }],
    	[{ align: [] }],
    	['blockquote', 'code-block'],
    	['link', 'image', 'video'],
    	['clean'],
    	['viewHtml']
  	];

	const icons = Quill.import('ui/icons');
  	icons['viewHtml'] = '<i class="fa fa-code" aria-hidden="true"></i>';

  	document.querySelectorAll('.jq-quilljs-editor--editor').forEach(editorDiv => 
	{
    	let htmlMode = false;
    	let htmlTextarea = null;

    	const handlers = 
		{
      		viewHtml: function (value) 
			{
        		if (!quill) return;
				
        		if (!htmlMode) 
				{
          			htmlMode = true;
          			editorDiv.style.display = 'none';

					htmlTextarea = document.createElement('textarea');
		          	htmlTextarea.className = 'quill-html-editor';
		          	htmlTextarea.style.width = '100%';
		          	htmlTextarea.style.boxSizing = 'border-box';
		          	htmlTextarea.style.minHeight = (editorDiv.offsetHeight || 200) + 'px';
		          	htmlTextarea.value = quill.root.innerHTML.trim();

          			editorDiv.parentNode.insertBefore(htmlTextarea, editorDiv.nextSibling);
          			htmlTextarea.focus();
        		} 
				else 
				{
          			htmlMode = false;
					
          			if (htmlTextarea) 
					{
            			quill.root.innerHTML = htmlTextarea.value;
            			htmlTextarea.remove();
            			htmlTextarea = null;
          			}
					
          			editorDiv.style.display = '';
          			quill.focus();
        		}
      		}
    	};

    	const quill = new Quill(editorDiv, 
		{
      		theme: 'snow',
      		modules: 
			{
        		toolbar: 
				{
          			container: toolbarContainer,
          			handlers: handlers
        		}
      		}
    	});

    	const container = editorDiv.closest('.jq-quilljs-editor--container');
    	const hiddenTextarea = container ? container.querySelector('.jq-quilljs-editor--content') : null;
    	if (hiddenTextarea && hiddenTextarea.value && hiddenTextarea.value.trim() !== '') 
		{
      		quill.root.innerHTML = hiddenTextarea.value;
    	}

    	const form = editorDiv.closest('form.jq-quilljs-editor--form');
		
    	if (form) 
		{
      		if (!form.__quill_submit_hooked) 
			{
        		form.addEventListener('submit', function () 
				{
          			form.querySelectorAll('.jq-quilljs-editor--container').forEach(cont => 
					{
			            const ed = cont.querySelector('.jq-quilljs-editor--editor');
			            const ta = cont.querySelector('.jq-quilljs-editor--content');
			            const q = Quill.find(ed);
						
			            if (q && ta) 
						{
			            	ta.value = q.root.innerHTML;
			            }
          			});
        		});
				
        		form.__quill_submit_hooked = true;
      		}
    	}
  	});
});
