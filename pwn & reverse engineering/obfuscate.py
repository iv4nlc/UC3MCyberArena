import base64

def rot13(data):
    result = []
    for char in data:
        if 'a' <= char <= 'z':
            result.append(chr(((ord(char) - ord('a') + 13) % 26) + ord('a')))
        elif 'A' <= char <= 'Z':
            result.append(chr(((ord(char) - ord('A') + 13) % 26) + ord('A')))
        else:
            result.append(char)
    return ''.join(result)

def xor_encrypt_decrypt(data, key):
    return ''.join(chr(ord(c) ^ key) for c in data)

def substitute_characters(data):
    substitution_dict = {
        'A': '1', 'E': '2', 'I': '3', 'O': '4', 'U': '5',
        'a': '6', 'e': '7', 'i': '8', 'o': '9', 'u': '0',
    }
    return ''.join(substitution_dict.get(c, c) for c in data)

flag = "XXXXXXXXXXXXXXXXX"
pokemon = "YYYYYYYYYYYY"

key = 42

flag_substituted = substitute_characters(flag)
pokemon_substituted = substitute_characters(pokemon)

flag_rot13 = rot13(flag_substituted)
pokemon_rot13 = rot13(pokemon_substituted)

encoded_flag = xor_encrypt_decrypt(flag_rot13, key)
encoded_pokemon = xor_encrypt_decrypt(pokemon_rot13, key)

encoded_flag_base64 = base64.b64encode(encoded_flag.encode()).decode()
encoded_pokemon_base64 = base64.b64encode(encoded_pokemon.encode()).decode()

print("Obfuscated Flag:", encoded_flag_base64)
print("Obfuscated Pokemon:", encoded_pokemon_base64)
