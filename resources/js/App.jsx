import React from 'react';
import { createRoot } from 'react-dom/client'
import PlayPage from './components/play-page';

export default function App(){
    return(
        <PlayPage />
    );
}

if(document.getElementById('root')){
    createRoot(document.getElementById('root')).render(<App />)
}
