export default function Profile() {
    return (<>
        <div className="md:w-1/3 p-5">
            <div className="flex flex-col items-center justify-center space-y-2">
                <img className="rounded-full w-14 h-14 mr-2" src="//placekitten.com/50/50" alt="profile"/>
                <strong>@username</strong>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit ullam voluptatum, praesentium eius ipsum minima molestias velit pariatur, aperiam non mollitia libero aliquid repellendus porro repudiandae, laboriosam officiis corrupti modi.</p>

            </div>
        </div>
        </>
    )
}
