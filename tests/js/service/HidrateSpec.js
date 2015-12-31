describe('Hidrate', function() {

    it('Should receive an array an normalize it', function() {
        var data = {
            complementary: [
                {
                    id: 289,
                    identifier: "1",
                    description: "1"
                },
                {
                    id: 290,
                    identifier: "222",
                    description: "222"
                },
                {
                    id: 291,
                    identifier: "3",
                    description: "3"
                },
                {
                    id: 292,
                    identifier: "4",
                    description: "4"
                }
            ],
                business: [
                {
                    id: 254,
                    identifier: "11",
                    description: "11"
                },
                {
                    id: 255,
                    identifier: "2",
                    description: "2"
                },
                {
                    id: 256,
                    identifier: "3",
                    description: "3"
                },
                {
                    id: 257,
                    identifier: "44",
                    description: "44"
                }
            ],
                reference: [
                {
                    id: 251,
                    identifier: "111",
                    description: "111"
                },
                {
                    id: 252,
                    identifier: "2222",
                    description: "2222"
                },
                {
                    id: 253,
                    identifier: "3",
                    description: "3"
                },
                {
                    id: 254,
                    identifier: "444",
                    description: "444"
                }
            ]
        }


        expect(data.complementary[0].id).toBe(289);
    });

});