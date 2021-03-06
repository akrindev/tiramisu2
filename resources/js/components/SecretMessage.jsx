import Messages from "./Messages"

export default function SecretMessage() {
    return (
    <>
        <div className="md:w-2/3 mb-10">

            <div className="relative w-full px-5 py-10">
                <form action="#" method="post">
                    <div>
                        <label htmlFor="pesan">Pesan Rahasia</label>
                        <textarea className="w-full rounded-md p-3 border border-blue-400" name="pesan" id="pesan" cols="15" rows="4" placeholder="Pesan rahasia..."></textarea>
                    </div>

                    <div className="space-x-1 font-bold">
                        <input type="radio" name="privasi" value="1" checked="checked"/> <span>Public</span>
                        <input type="radio" name="privasi" value="0" className="ml-3 mr-3"/> <span> Private</span>
                    </div>

                    <div className="absolute mt-20 bottom-1 right-4">
                        <button type="submit" className="px-6 py-3 bg-blue-500 hover:bg-blue-800 text-white rounded-lg">kirim</button>
                    </div>
                </form>
            </div>

            {/* pesan pesan rahasia */}

            <div className="flex flex-col my-10 space-y-3 border-t border-blue-100 py-5">
                {[1,2,3,4,5,6].map(i => <Messages key={i}/>)}
            </div>

        </div>
    </>
    )
}
