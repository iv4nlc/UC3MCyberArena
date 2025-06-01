
import wave

# Función para convertir un texto en binario
def text_to_bin(text):
    return ''.join(format(ord(i), '08b') for i in text)

# Cargar el archivo de audio original
song = wave.open("rain.wav", mode='rb')

# Obtener los frames de audio
frame_bytes = bytearray(list(song.readframes(song.getnframes())))

# El mensaje a esconder (la flag)
message = "###XXXXXXXXXXXXXXXXX###"  # Agregar los caracteres de relleno
message_bin = text_to_bin(message)

# Reemplazar los LSB en los frames de audio con los bits del mensaje
message_len = len(message_bin)
for i in range(message_len):
    # Cambiar el bit menos significativo de cada byte en el audio
    frame_bytes[i] = (frame_bytes[i] & 0xFE) | int(message_bin[i])

# Crear un nuevo archivo de audio con la flag oculta
song.close()
encoded_song = wave.open("rain2.wav", mode='wb')

# Copiar parámetros del audio original
encoded_song.setparams(song.getparams())

# Escribir los nuevos frames modificados en el archivo
encoded_song.writeframes(frame_bytes)

# Cerrar el archivo de audio
encoded_song.close()

print("Flag escondida con éxito en 'rain2.wav'")
